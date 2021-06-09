interface KeyValList {
    [key: string]: number
}

export interface ActionModelSpec {
    parameters: KeyValList,
    paths: Array<any>,
    properties: Array<any>,
    required: Array<string>,
    type: string
}

export interface ActionModelList {
    [modelName: string]: ActionModelSpec
}

interface GetActionSpec {
    collection?: ActionModelList,
    item?: ActionModelList
}

export interface ActionsSpec {
    get?: GetActionSpec,
    post?: ActionModelList,
    put?: ActionModelList,
    delete?: ActionModelList
}

export interface ScalarProperty {
    type?: string,
    format?: string,
    readOnly?: boolean,
    description?: string,
    maxLength?: number,
    default?: any,
    enum?: Array<string|number>,
    label: string,
    helpText?: string,
}

export interface FkProperty {
    $ref: string,
    label: string,
    helpText?: string,
}

export type PropertySpec =  ScalarProperty |FkProperty;

export interface PropertyList {
    [key: string]: PropertySpec
}

export interface EntitySpec {
    actions: ActionsSpec,
    properties: PropertyList,
}

export default interface ParsedApiSpecInterface {
    [key: string]: EntitySpec
}