<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

trait AuthEndpointTrait
{
    private function getAdminLoginSpec()
    {
        return [
            'post' => [
                "tags" => [
                    "Auth"
                ],
                "operationId" => "postAdminAuthenticate",
                "consumes" => [
                    "application/x-www-form-urlencoded",
                ],
                "produces" => [
                    "application/json",
                ],
                "summary" => "Retrieve JWT token",
                "parameters" => [
                    [
                        "name" => "username",
                        "in" => "formData",
                        "type" => 'string',
                        "required" => true
                    ],
                    [
                        "name" => "password",
                        "in" => "formData",
                        "type" => 'string',
                        "format" => 'password',
                        "required" => true
                    ]
                ],
                "responses" => [
                    "200" => [
                        "description" => "Valid credentials"
                    ],
                    "400" => [
                        "description" => "Invalid input"
                    ],
                    "401" => [
                        "description" => "Bad credentials"
                    ]
                ]
            ]
        ];
    }

    private function getUserLoginSpec()
    {
        return [
            'post' => [
                "tags" => [
                    "Auth"
                ],
                "operationId" => "postUserAuthenticate",
                "consumes" => [
                    "application/x-www-form-urlencoded",
                ],
                "produces" => [
                    "application/json",
                ],
                "summary" => "Retrieve JWT token",
                "parameters" => [
                    [
                        "name" => "email",
                        "in" => "formData",
                        "type" => 'string',
                        "required" => true
                    ],
                    [
                        "name" => "password",
                        "in" => "formData",
                        "type" => 'string',
                        "format" => 'password',
                        "required" => true
                    ]
                ],
                "responses" => [
                    "200" => [
                        "description" => "Valid credentials"
                    ],
                    "400" => [
                        "description" => "Invalid input"
                    ],
                    "401" => [
                        "description" => "Bad credentials"
                    ]
                ]
            ]
        ];
    }

    private function getTokenRefreshSpec()
    {
        return [
            'post' => [
                "tags" => [
                    "Auth"
                ],
                "operationId" => "postTokenRefresh",
                "consumes" => [
                    "application/x-www-form-urlencoded",
                ],
                "produces" => [
                    "application/json",
                ],
                "summary" => "Retrieve JWT token",
                "parameters" => [
                    [
                        "name" => "refresh_token",
                        "in" => "formData",
                        "type" => 'string',
                        "required" => true
                    ]
                ],
                "responses" => [
                    "200" => [
                        "description" => "Valid credentials"
                    ],
                    "400" => [
                        "description" => "Invalid input"
                    ],
                    "401" => [
                        "description" => "Bad credentials"
                    ]
                ]
            ]
        ];
    }
}
