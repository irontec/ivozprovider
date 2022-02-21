import React from 'react';
import { PropertyCustomFunctionComponent } from '../form/Field/CustomComponentWrapper';

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

type PropertyType = 'array' | 'file' | 'boolean' | 'integer' | 'string';
type PropertyFormat = 'date-time' | 'date' | 'time';

export interface ScalarProperty {
    type?: PropertyType,
    format?: PropertyFormat,
    readOnly?: boolean,
    description?: string,
    maxLength?: number,
    minimum?: number,
    maximum?: number,
    default?: any,
    enum?: KeyValList,
    null?: string | React.ReactElement<any>,
    visualToggle?: visualToggleValue
    label: string | React.ReactElement<any>,
    prefix?: string | React.ReactElement<any>,
    component?: PropertyCustomFunctionComponent<any>,
    required: boolean,
    pattern?: RegExp,
    helpText?: string | React.ReactElement<any>,
}

export interface FkProperty {
    type?: PropertyType,
    $ref: string,
    readOnly?: boolean,
    label: string | React.ReactElement<any>,
    prefix?: string | React.ReactElement<any>,
    null?: string | React.ReactElement<any>,
    required: boolean,
    component?: PropertyCustomFunctionComponent<any>,
    helpText?: string,
}

export type PropertySpec = ScalarProperty | FkProperty;

export const isPropertyFk = (property: PropertySpec): property is FkProperty => {
    return (property as FkProperty).$ref !== undefined;
}

export const isPropertyScalar = (property: PropertySpec): property is ScalarProperty => {
    return (property as FkProperty).$ref === undefined;
}

export type PartialPropertyList = {
    [index: string]: Partial<PropertySpec>
};

export interface PropertyList {
    [key: string]: PropertySpec
}

export interface fkPropertyList {
    [key: string]: FkProperty,
}

export interface EntitySpec {
    actions: ActionsSpec,
    properties: PropertyList,
}

export default interface ParsedApiSpecInterface {
    [key: string]: EntitySpec,
}