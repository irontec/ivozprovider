import { EntityFormProps } from './../../.history/src/entities/DefaultEntityBehavior_20210903123211';
import { PropertyList, PropertySpec } from "services/Api/ParsedApiSpecInterface";
import EntityService from "services/Entity/EntityService";

export type ListDecoratorPropsType = {
    field: string,
    row: any,
    property: Partial<PropertySpec>
};
export type ListDecoratorType = (props: ListDecoratorPropsType) => any;

type foreignKeyResolverType = (data: any, entityService: EntityService) => Promise<any>;
type foreignKeyGetterType = () => Promise<any>;
type AclType = {
    create: boolean,
    read: boolean,
    update: boolean,
    delete: boolean,
};

export type PropertiesList = {
    [index: string]: Partial<PropertySpec>
};

export default interface EntityInterface {
    initialValues: any,
    validator: (values: any, properties: PropertiesList) => any,
    marshaller: (T: any, properties: PropertiesList) => any,
    unmarshaller: (T: any, properties: PropertiesList) => any,
    foreignKeyResolver: foreignKeyResolverType,
    foreignKeyGetter: foreignKeyGetterType,
    Form: React.FunctionComponent<EntityFormProps>,
    View: React.FunctionComponent,
    ListDecorator: ListDecoratorType,
    RowIcons: React.FunctionComponent,
    acl: AclType,
    iden: string,
    title: string | JSX.Element,
    path: string,
    columns: Array<string>,
    properties: PropertiesList,
    toStr: Function,
    defaultOrderBy: string,
    icon: JSX.Element
}