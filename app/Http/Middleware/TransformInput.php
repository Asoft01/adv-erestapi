<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $transformer)
    {
        $tranformedInput = [];

        // We want to obtain only the inputs and not the query strings in the url
        foreach ($request->request->all() as $input => $value) {
            // Try knowing what the user sent as original input
            $tranformedInput[$transformer::originalAttribute($input)] = $value;
        }

        $request->replace($tranformedInput);
        
        // return $next($request);
        $response = $next($request);

        if(isset($response->exception) && $response->exception instanceof ValidationException){
            // directly obtain the data of the response
            $data = $response->getData();

            $transformedErrors = [];
            foreach ($data->error as $field => $error) {
                $transformedField = $transformer::transformedAttribute($field);

                $transformedErrors[$transformedField] = str_replace($field, $transformedField, $error);
            }

            $data->error = $transformedErrors;
            $response->setData($data);
        }

        return $response;
    }
}
