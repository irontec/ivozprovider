interface KeyValList {
    [key: string]: any
}

export default interface OpenApiSpecInterface {

    definitions: KeyValList;
    paths: KeyValList;
}