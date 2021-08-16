
import { List, Create, Edit, View } from 'layout/content/index';
import ParsedApiSpecInterface from 'services/Api/ParsedApiSpecInterface';
import EntityService from 'services/Entity/EntityService';
import EntityInterface from './EntityInterface';
import entities from './index';

export type RouteSpec = {
    key: string,
    path: string,
    entity: EntityInterface,
    component: Function
};
const routes:Array<RouteSpec> = [];

export const parseRoutes = (apiSpec: ParsedApiSpecInterface) => {

    const routes:Array<RouteSpec> = [];

    for (const name in entities) {
        const entity = entities[name];

        if (!apiSpec[entity.iden]) {
            console.log('entity not found', entity.iden);
            continue;
        }

        const entityService = new EntityService(
            apiSpec[entity.iden].actions,
            apiSpec[entity.iden].properties,
            entity
        );

        const acls = entityService.getAcls();

        if (acls.create) {
            routes.push({
                key: `${name}-create`,
                path: `${entity.path}/create`,
                entity: entity,
                component: Create
            });
        }

        if (acls.read) {
            routes.push({
                key: `${name}-list`,
                path: `${entity.path}`,
                entity: entity,
                component: List
            });
        }

        if (acls.update) {
            routes.push({
                key: `${name}-update`,
                path: `${entity.path}/:id/update`,
                entity: entity,
                component: Edit
            });

        } else if (acls.read) {
            routes.push({
                key: `${name}-detailed`,
                path: `${entity.path}/:id/detailed`,
                entity: entity,
                component: View
            });
        }
    }

    return routes;
}

export default routes;