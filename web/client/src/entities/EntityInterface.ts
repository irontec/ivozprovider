import EntityService from "services/Entity/EntityService";

export type ListDecoratorPropsType = {
    field: string,
    row: any
};
export type ListDecoratorType = (props:ListDecoratorPropsType) => any;

type foreignKeyResolverType = (data: any, entityService: EntityService) => Promise<any>;
type foreignKeyGetterType = () => Promise<any>;
type AclType = {
    create: boolean,
    read: boolean,
    update: boolean,
    delete: boolean,
};

export default interface EntityInterface {
    initialValues: any,
    validator: (values: any) => any,
    marshaller: (T: any) => any,
    unmarshaller:(T: any) => any,
    foreignKeyResolver: foreignKeyResolverType,
    foreignKeyGetter: foreignKeyGetterType,
    Form: React.FunctionComponent,
    ListDecorator: ListDecoratorType,
    RowIcons: React.FunctionComponent,
    acl: AclType,
    iden: string,
    title: string | JSX.Element,
    path: string,
    columns: any,
    properties: any,
    defaultOrderBy: string,
    icon: JSX.Element
}