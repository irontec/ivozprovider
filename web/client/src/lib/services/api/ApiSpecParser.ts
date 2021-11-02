import OpenApiSpecInterface, { OpenApiPaths } from './OpenApiSpecInterface';
import ParsedApiSpecInterface from './ParsedApiSpecInterface';

type KeyValList = {
    [key: string]: any
}

export default class ApiSpecParser {

    public parse(spec: OpenApiSpecInterface): ParsedApiSpecInterface {

        return this.parseSpec(spec);
    }

    private parseSpec(apiSpec: OpenApiSpecInterface): ParsedApiSpecInterface {

        const responseData: any = {};
        for (const modelName in apiSpec.definitions) {

            const entityNameRoot = modelName.split('-').shift() as string;

            if (!responseData[entityNameRoot]) {
                responseData[entityNameRoot] = {};
            }

            const paths = this.getEntityPaths(
                modelName,
                apiSpec
            );

            if (modelName.indexOf('_') > 0 && Object.keys(paths).length) {
                const parentModelName = modelName.split('_').shift() as string;
                responseData[parentModelName][modelName] = {
                    ...apiSpec.definitions[parentModelName],
                    paths
                };
            }

            responseData[entityNameRoot][modelName] = {
                ...apiSpec.definitions[modelName],
                paths
            };
        }

        const response: any = {};
        for (const modelName in responseData) {
            response[modelName] = {
                properties: {}
            };

            const properties: KeyValList = [];
            for (const modelVariant in responseData[modelName]) {
                const paths = responseData[modelName][modelVariant].paths;

                const isEmpty = Object.keys(paths).length === 0;
                if (isEmpty) {
                    response[modelName].properties = {
                        ...response[modelName].properties,
                        ...responseData[modelName][modelVariant].properties
                    }
                    continue;
                }

                for (const method in paths) {

                    if (!response[modelName].actions) {
                        response[modelName].actions = {};
                    }

                    if (!response[modelName].actions[method]) {
                        response[modelName].actions[method] = {};
                    }

                    const variantData = responseData[modelName][modelVariant];
                    const modelVariantPaths: any = paths[method];

                    if (method !== 'get') {

                        response[modelName].actions[method][modelVariant] = {
                            paths: Object.keys(paths[method]),
                            parameters: modelVariantPaths[Object.keys(modelVariantPaths)[0]].parameters,
                            properties: variantData.properties,
                            required: variantData.required,
                            type: variantData.type,
                        };

                    } else if (this.isCollection(paths.get)) {

                        if (!response[modelName].actions[method]['collection']) {
                            response[modelName].actions[method]['collection'] = {};
                        }

                        response[modelName].actions[method]['collection'][modelVariant] = {
                            paths: this.getCollectionPaths(paths.get),
                            parameters: modelVariantPaths[Object.keys(modelVariantPaths)[0]].parameters,
                            properties: variantData.properties,
                            required: variantData.required,
                            type: variantData.type,
                        };
                    } else if (this.isItem(paths.get)) {

                        if (!response[modelName].actions[method]['item']) {
                            response[modelName].actions[method]['item'] = {};
                        }

                        response[modelName].actions[method]['item'][modelVariant] = {
                            paths: this.getItemPaths(paths.get),
                            parameters: modelVariantPaths[Object.keys(modelVariantPaths)[0]].parameters,
                            properties: variantData.properties,
                            required: variantData.required,
                            type: variantData.type,
                        };
                    }

                    for (const propertyName in variantData.properties) {

                        if (!properties[propertyName]) {
                            properties[propertyName] = {};
                        }

                        const isRequired =
                            variantData.required
                            && variantData.required.includes(propertyName);

                        properties[propertyName] = {
                            ...properties[propertyName],
                            ...variantData.properties[propertyName],
                            required: isRequired || false
                        };
                    }

                    response[modelName].properties = properties;
                }
            }
        }

        return response;
    }

    private isCollection(paths: any) {
        const collectionPaths = this.getCollectionPaths(paths);

        return collectionPaths.length > 0;
    }

    private getCollectionPaths(paths: any) {
        return Object.keys(paths).filter((key: string) => {
            return paths[key]?.responses['200']?.schema?.items;
        })
    }

    private isItem(paths: any) {
        const itemPaths = this.getItemPaths(paths);

        return itemPaths.length > 0;
    }

    private getItemPaths(paths: any) {
        return Object.keys(paths).filter((key: string) => {
            return paths[key]?.responses['200']?.schema?.$ref || paths[key]?.produces.includes('application/octet-stream');
        });
    }

    public getEntityBasePath(entityNameRoot: string): string {
        const underScored = entityNameRoot.replace(/([A-Z])/g, (upperString: string) => {
            return "_" + upperString.toLowerCase();
        });

        return '/' + underScored.slice(1);
    }

    private getEntityPaths(entityNameRoot: string, apiSpec: OpenApiSpecInterface): OpenApiPaths {

        entityNameRoot = entityNameRoot.replace('-', '\-');
        const endpoints: OpenApiPaths = {};

        for (const endpoint in apiSpec.paths) {

            for (const method in apiSpec.paths[endpoint]) {
                const action = apiSpec.paths[endpoint][method];

                const isGetRequest = ['get'].includes(method.toLowerCase())
                    ? true
                    : false;

                const matches = isGetRequest
                    ? this.filterByResponseSchema(action, entityNameRoot)
                    : this.filterByRequestSchema(action, entityNameRoot)

                const uploadActionMatch =
                    !isGetRequest
                    && (this.filterByResponseSchema(action, entityNameRoot)).length > 0
                    && this.isUploadAction(action);

                if (!matches.length && !uploadActionMatch) {
                    continue;
                }

                if (!endpoints[method]) {
                    endpoints[method] = {};
                }

                endpoints[method][endpoint] = action;

                const deleteAction = apiSpec.paths[endpoint]['delete'];
                if (isGetRequest && deleteAction) {

                    if (!endpoints['delete']) {
                        endpoints['delete'] = {};
                    }

                    endpoints['delete'][endpoint] = deleteAction;
                }
            }
        }

        return endpoints;
    }

    private filterByRequestSchema(action: any, entityNameRoot: string): Array<string> {

        const pattern = `^\#\/definitions\/${entityNameRoot}$`;
        const regExp = new RegExp(pattern);

        return Object
            .values(action.parameters)
            .map((parameter: any) => {
                if (parameter?.in === 'formData') {
                    if (entityNameRoot.toLowerCase() === parameter?.name.toLowerCase()) {
                        return `#/definitions/${entityNameRoot}`;
                    }
                }

                return parameter?.schema?.$ref;
            })
            .filter((ref: string) => {
                return ref && ref.search(regExp) === 0;
            });
    }

    private filterByResponseSchema(action: any, entityNameRoot: string): Array<string> {

        const isFileDownload =
            action.produces
            && action.produces.includes('application/octet-stream');

        if (isFileDownload) {
            return Object
                .values(action.responses)
                .filter((response: any) => response?.description && response.description.indexOf('#/definitions/') >= 0)
                .map((response: any) => response.description.replace('#/definitions/', '') ?? '')
                .map((description: string) => {
                    const modelMatch = description.toLowerCase() === entityNameRoot.toLowerCase();
                    return modelMatch
                        ? entityNameRoot
                        : '';
                })
                .filter((description: string) => {
                    return description !== '';
                });
        }

        const pattern = `^\#\/definitions\/${entityNameRoot}$`;
        const regExp = new RegExp(pattern);

        return Object
            .values(action.responses)
            .map((response: any) => response.schema)
            .map((schema: any) => {
                return schema?.items?.$ref ?? schema?.$ref;
            })
            .filter((ref: string) => {
                return ref && ref.search(regExp) === 0;
            });
    }

    private isUploadAction(action: any): boolean {
        const fileParams: Array<any> = action
            .parameters
            .filter((param: any) => {
                return param.type === 'file';
            });

        return fileParams.length > 0;
    }
}