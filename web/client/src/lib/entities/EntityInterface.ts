import { CancelToken } from "axios";
import { EntityList } from "lib/router/parseRoutes";
import { PartialPropertyList, PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import EntityService, { EntityValues, VisualToggleStates } from "lib/services/entity/EntityService";
import React from "react";
import { EntityFormProps } from "./DefaultEntityBehavior";

export type ListDecoratorPropsType = {
    field: string,
    row: any,
    property: PropertySpec
};
export type ListDecoratorType = (props: ListDecoratorPropsType) => any;

export interface foreignKeyResolverProps {
    data: any,
    allowLinks?: boolean,
    entityService?: EntityService,
    cancelToken?: CancelToken,
    entities?: EntityList,
    skip?: Array<string>
}

export type foreignKeyResolverType = (props: foreignKeyResolverProps) => Promise<any>;
export type ForeignKeyGetterType = (cancelToken?: CancelToken) => Promise<any>;
export type EntityAclType = {
    create: boolean,
    read: boolean,
    detail: boolean,
    update: boolean,
    delete: boolean,
};

export interface ViewProps {
    entityService: EntityService,
    row: any,
    groups: any,
}
export type ViewType = (props: ViewProps) => JSX.Element | null;


type ToStrType = (row: EntityValues) => string;

export interface EntityValidatorValues { [label: string]: string }
export type EntityValidatorResponse = Record<string, string | JSX.Element>;
export type EntityValidator = (
    values: EntityValidatorValues,
    properties: PartialPropertyList,
    visualToggles: VisualToggleStates
) => EntityValidatorResponse;

export enum OrderDirection {
    asc = 'asc',
    desc = 'desc',
}

export default interface EntityInterface {
    initialValues: any,
    validator: EntityValidator,
    marshaller: (T: any, properties: PartialPropertyList) => any,
    unmarshaller: (T: any, properties: PartialPropertyList) => any,
    foreignKeyResolver: foreignKeyResolverType,
    foreignKeyGetter: ForeignKeyGetterType,
    Form: React.FunctionComponent<EntityFormProps>,
    View: ViewType,
    ListDecorator: ListDecoratorType,
    acl: EntityAclType,
    iden: string,
    title: string | JSX.Element,
    path: string,
    columns: Array<string>,
    properties: PartialPropertyList,
    toStr: ToStrType,
    defaultOrderBy: string,
    defaultOrderDirection: OrderDirection,
    icon: React.FunctionComponent
}