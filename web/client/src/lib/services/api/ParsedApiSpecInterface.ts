import React from 'react';

export interface KeyValList {
    [key: string]: unknown
}

export interface KeyNumList {
    [key: string]: number
}

interface ActionParam {
    name: string,
    in: "query",
    required: boolean,
    type: "string"
}

export interface ActionModelSpec {
    parameters: { [key: string | number]: ActionParam },
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

export interface visualToggleList {
    [fldName: string]: visualToggleValue
}

export interface visualToggleValue {
    [value: string]: visualToggle
}

export interface visualToggle {
    show: Array<string>,
    hide: Array<string>,
}

enum customComponentContext {
    write = "write",
    read = "read",
}

export interface propertyCustomComponentProps {
    _context?: customComponentContext,
    _columnName?: string
}

export type PropertyCustomComponent<P extends propertyCustomComponentProps> = (props: P) => JSX.Element;

export interface ScalarProperty {
    type?: string,
    format?: string,
    readOnly?: boolean,
    description?: string,
    maxLength?: number,
    default?: any,
    enum?: KeyValList,
    null?: string | React.ReactElement<any>,
    visualToggle?: visualToggleValue
    label: string | React.ReactElement<any>,
    prefix?: string | React.ReactElement<any>,
    component?: PropertyCustomComponent<any>,
    required: boolean,
    pattern?: RegExp,
    helpText?: string | React.ReactElement<any>,
}

export interface FkProperty {
    $ref: string,
    label: string | React.ReactElement<any>,
    prefix?: string | React.ReactElement<any>,
    null?: string | React.ReactElement<any>,
    required: boolean,
    helpText?: string,
}

export type PropertySpec = ScalarProperty | FkProperty;

export const isPropertyFk = (property: PropertySpec): property is FkProperty => {
    return (property as FkProperty).$ref !== undefined;
}

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