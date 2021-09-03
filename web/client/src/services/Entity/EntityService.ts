import EntityInterface, { ListDecoratorPropsType, PropertiesList } from "entities/EntityInterface";
import { FunctionComponent } from "react";
import {
    ActionsSpec, PropertyList, ActionModelList, ScalarProperty,
    ActionModelSpec, visualToggleList
} from "services/Api/ParsedApiSpecInterface";

export default class EntityService {
    constructor(
        private actions: ActionsSpec,
        private properties: PropertyList,
        private entityConfig: EntityInterface
    ) {
    }

    public getProperties(): PropertiesList {
        const response: PropertiesList = {};
        const properties = this.entityConfig.properties;

        for (const idx in properties) {

            const propertyOverwrite = properties[idx] || {};
            const label = properties[idx].label || '';

            response[idx] = {
                ...this.properties[idx],
                ...propertyOverwrite,
                label
            };
        }

        return response;
    }

    public getColumns(): PropertyList {
        const response: PropertyList = {};
        const properties = this.entityConfig.properties;
        const columns = this.entityConfig.columns.length
            ? this.entityConfig.columns
            : Object.keys(properties);

        for (const idx of columns) {
            if (!this.properties[idx] && !properties[idx]) {
                //console.warn(`skipping property ${idx}`);
                continue;
            }

            const propertyOverwrite = properties[idx] || {};
            const label = properties[idx].label || '';

            response[idx] = {
                ...this.properties[idx],
                ...propertyOverwrite,
                label
            };
        }

        return response;
    }

    public getCollectionColumns(): PropertyList {
        const allColumns = this.getColumns();
        const collectionAction = this.getFromModelList(
            this.actions?.get?.collection || {},
            this.entityConfig.path
        );
        const collectionActionFields = Object.keys(collectionAction?.properties || {});

        const response: PropertyList = {};
        const restrictedColumns = this.entityConfig.columns.length
            ? this.entityConfig.columns
            : collectionActionFields;

        for (const colName in allColumns) {
            if (!restrictedColumns.includes(colName)) {
                continue;
            }

            response[colName] = allColumns[colName];
        }

        return response;
    }

    public getVisualToggleRules(): visualToggleList {
        const rules: visualToggleList = {};
        const properties = this.entityConfig.properties;
        for (const idx in properties) {
            const visualToggle = (properties[idx] as ScalarProperty).visualToggle;
            if (!visualToggle) {
                continue;
            }

            rules[idx] = visualToggle;
        }

        return rules;
    }

    public getVisualToggles(): any {
        const properties = this.entityConfig.properties;
        const visualToggles = Object.keys(properties).reduce(
            (accumulator: any, fldName: string) => {
                accumulator[fldName] = true;
                return accumulator;
            },
            {}
        );

        return visualToggles;
    }

    public updateVisualToggle(fld: string, value: any, visualToggles: any) {
        const rules = this.getVisualToggleRules();

        if (!rules[fld]) {
            return visualToggles;
        }

        if (!rules[fld][value]) {
            return visualToggles;
        }

        for (const hideFld of rules[fld][value]['hide']) {
            visualToggles[hideFld] = false;
        }

        for (const showFld of rules[fld][value]['show']) {
            visualToggles[showFld] = true;
        }

        return visualToggles;
    }

    public getDefultValues() {
        const response: any = {};
        const columns = this.getColumns();

        for (const idx in columns) {

            const column: ScalarProperty = columns[idx];
            if (!column.default && !column.enum) {
                if (column.type === 'array') {
                    response[idx] = [];
                }
                continue;
            }

            if (!column.default) {
                response[idx] = Object.keys(column.enum as any)[0];
            } else if (column.type === 'boolean') {
                response[idx] = parseInt(column.default);
            } else {
                response[idx] = column.default;
            }
        }

        return response;
    }

    public getCollectionPath(path: string | null = null): string | null {
        const collectionAction = this.actions?.get?.collection || {};

        const action = this.getFromModelList(collectionAction, path);

        return action?.paths[0];
    }

    public getItemPath(path: string | null = null): string | null {
        const itemActions = this.actions?.get?.item || {};

        const action = this.getFromModelList(itemActions, path);

        return action?.paths[0];
    }

    public getPostPath(path: string | null = null): string | null {
        const itemActions = this.actions?.post || {};

        const action = this.getFromModelList(itemActions, path);

        return action?.paths[0];
    }

    public getPutPath(path: string | null = null): string | null {
        const itemActions = this.actions?.put || {};

        const action = this.getFromModelList(itemActions, path);

        return action?.paths[0];
    }

    public getDeletePath(path: string | null = null): string | null {
        const itemActions = this.actions?.delete || {};

        const action = this.getFromModelList(itemActions, path);

        return action?.paths[0];
    }

    public getTitle() {
        return this.entityConfig.title;
    }

    public getOrderBy(): string {
        return this.entityConfig?.defaultOrderBy || 'id';
    }

    public getOrderDirection(): string {
        return 'desc';
    }

    public getAcls() {
        const create: boolean = this.entityConfig.acl.create && this.actions.post
            ? true
            : false;

        const read: boolean = this.entityConfig.acl.read && this.actions.get
            ? true
            : false;

        const update: boolean = this.entityConfig.acl.update && this.actions.put
            ? true
            : false;

        const remove: boolean = this.entityConfig.acl.delete && this.actions.delete
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

    public getForeignKeyGetter() {
        return this.entityConfig.foreignKeyGetter;
    }

    public getListDecorator(): React.FunctionComponent<ListDecoratorPropsType> {
        return this.entityConfig.ListDecorator;
    }

    public getRowActions(): FunctionComponent {
        return this.entityConfig.RowIcons;
    }

    public getPropertyFilters(propertyName: string, path?: string): Array<string> {
        const filters = this.getFilters(path);

        return filters[propertyName] || [];
    }

    private getFilters(path?: string): any {
        const collectionAction = this.actions?.get?.collection || {};
        const action = this.getFromModelList(collectionAction, path);
        if (!action) {
            return {};
        }

        const filters: any = {};
        // eslint-disable-next-line
        const filterRegExp = new RegExp(/^([^\[]+)\[?([^\]]*)\]?/);
        const parameters: any = action.parameters || {};

        for (const idx in parameters) {

            const name = parameters[idx].name;
            let [, fieldName, modifier] = name.match(filterRegExp);
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

    private getFromModelList(modelList: ActionModelList, path: string | null = null): ActionModelSpec | null {
        if (path) {
            const filteresModelList: ActionModelList = {};
            for (const idx in modelList) {
                if (!modelList[idx].paths.includes(path)) {
                    continue;
                }

                filteresModelList[idx] = modelList[idx];
            }

            return this.getFromModelList(filteresModelList, null);
        }

        const collectionModels = Object.keys(modelList);

        if (collectionModels.length) {
            return modelList[collectionModels[0]];
        }

        return null;
    }

}