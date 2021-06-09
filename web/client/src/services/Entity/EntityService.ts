import EntityInterface, { ListDecoratorPropsType } from "entities/EntityInterface";
import { FunctionComponent } from "react";
import { ActionsSpec, PropertyList, ActionModelList, ScalarProperty } from "services/Api/ParsedApiSpecInterface";

export default class EntityService
{
    constructor(
        private actions:ActionsSpec,
        private properties:PropertyList,
        private entityConfig:EntityInterface
    ) {}

    public getColumns(): PropertyList
    {
        const response:PropertyList = {};

        for (const idx in this.entityConfig.columns) {
            if (!this.properties[idx]) {
                continue;
            }

            const propertyOverwrite = this.entityConfig.properties[idx] || {};

            response[idx] = {
                ...this.properties[idx],
                ...propertyOverwrite,
                label: this.entityConfig.columns[idx]
            };
        }

        return response;
    }

    public getCollectionColumns(): PropertyList
    {
        const columns = this.getColumns();
        const collectionAction = this.getFromModelList(
            this.actions?.get?.collection || {}
        );
        const collectionActionFields = Object.keys(collectionAction?.properties || {});

        const response:PropertyList = {};
        for (const colName in columns) {
            if (!collectionActionFields.includes(colName)) {
                continue;
            }

            response[colName] = columns[colName];
        }

        return response;
    }

    public getDefultValues()
    {
        const response:any = {};
        const columns = this.getColumns();

        for (const idx in columns) {

            if (!(columns[idx] as ScalarProperty).default) {
                continue;
            }

            if ((columns[idx] as ScalarProperty).type === 'boolean') {
                response[idx] = parseInt((columns[idx] as ScalarProperty).default);
            } else {
                response[idx] = (columns[idx] as ScalarProperty).default;
            }
        }

        return response;
    }

    public getCollectionPath(idx: string|null = null): string|null
    {
        const collectionAction = this.actions?.get?.collection || {};

        const action = this.getFromModelList(collectionAction, idx);

        return action?.paths[0];
    }

    public getItemPath(idx: string|null = null): string|null
    {
        const itemActions = this.actions?.get?.item || {};

        const action = this.getFromModelList(itemActions, idx);

        return action?.paths[0];
    }

    public getPostPath(idx: string|null = null): string|null
    {
        const itemActions = this.actions?.post || {};

        const action = this.getFromModelList(itemActions, idx);

        return action?.paths[0];
    }

    public getPutPath(idx: string|null = null): string|null
    {
        const itemActions = this.actions?.put || {};

        const action = this.getFromModelList(itemActions, idx);

        return action?.paths[0];
    }

    public getDeletePath(idx: string|null = null): string|null
    {
        const itemActions = this.actions?.delete || {};

        const action = this.getFromModelList(itemActions, idx);

        return action?.paths[0];
    }

    public getTitle()
    {
        return this.entityConfig.title;
    }

    public getOrderBy(): string
    {
        return this.entityConfig?.defaultOrderBy || 'id';
    }

    public getOrderDirection(): string
    {
        return 'desc';
    }

    public getAcls()
    {
        const create:boolean = this.entityConfig.acl.create && this.actions.post
            ? true
            : false;

        const read:boolean = this.entityConfig.acl.read && this.actions.get
            ? true
            : false;

        const update:boolean = this.entityConfig.acl.update && this.actions.post
            ? true
            : false;

        const remove:boolean = this.entityConfig.acl.delete && this.actions.post
            ? true
            : false;

        const acl = {
            create,
            read,
            update,
            delete: remove,
        };

        return acl;
    }

    public getForeignKeyGetter()
    {
        return this.entityConfig.foreignKeyGetter;
    }

    public getListDecorator(): React.FunctionComponent<ListDecoratorPropsType>
    {
        return this.entityConfig.ListDecorator;
    }

    public getRowActions(): FunctionComponent
    {
        return this.entityConfig.RowIcons;
    }

    public getPropertyFilters(propertyName: string): Array<string>
    {
        const filters = this.getFilters();

        return filters[propertyName] || [];
    }

    private getFilters(): any
    {
        const collectionAction = this.actions?.get?.collection || {};
        const action = this.getFromModelList(collectionAction);
        if (!action) {
            return {};
        }

        const filters:any = {};
        // eslint-disable-next-line
        const filterRegExp = new RegExp(/^([^\[]+)\[?([^\]]*)\]?/);
        const parameters:any = action.parameters || {};

        for (const idx in parameters) {

            const name = parameters[idx].name;
            let [,fieldName, modifier] = name.match(filterRegExp);
            if (!modifier) {
                modifier = parameters[idx].type === 'string'
                    ? 'exact'
                    : 'eq';
            }

            if (!filters[fieldName]) {
                filters[fieldName] = [];
            }

            if (filters[fieldName].includes(modifier)) {
                continue;
            }

            filters[fieldName].push(modifier);
        }

        return filters;
    }

    private getFromModelList(modelList: ActionModelList, idx: string|null = null)
    {
        if (idx && modelList[idx]) {
            return modelList[idx];
        }

        //Return first otherwise
        const collectionModels = Object.keys(modelList);

        if (collectionModels.length) {
            return modelList[collectionModels[0]];
        }

        return null;
    }

}