import { CancelToken } from "axios";
import { PartialPropertyList, PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import EntityService, { EntityValues, VisualToggleStates } from "lib/services/entity/EntityService";
import { EntityFormProps } from "./DefaultEntityBehavior";

export type ListDecoratorPropsType = {
    field: string,
    row: any,
    property: Partial<PropertySpec>
};
export type ListDecoratorType = (props: ListDecoratorPropsType) => any;

type foreignKeyResolverType = (data: any, entityService: EntityService) => Promise<any>;
export type ForeignKeyGetterType = (cancelToken?: CancelToken) => Promise<any>;
type AclType = {
    create: boolean,
    read: boolean,
    update: boolean,
    delete: boolean,
};

export type RowIconsType = (props: EntityValues) => JSX.Element;
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
    RowIcons: RowIconsType,
    acl: AclType,
    iden: string,
    title: string | JSX.Element,
    path: string,
    columns: Array<string>,
    properties: PartialPropertyList,
    toStr: ToStrType,
    defaultOrderBy: string,
    icon: JSX.Element
}