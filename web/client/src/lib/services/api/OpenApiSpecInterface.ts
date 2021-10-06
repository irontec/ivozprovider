export interface OpenApiDefinitions {
    [key: string]: any
}

export interface OpenApiPaths {
    [key: string]: any
}

export default interface OpenApiSpecInterface {
    definitions: OpenApiDefinitions;
    paths: OpenApiPaths;
}