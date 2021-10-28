import { List, Create, Edit, View } from 'lib/layout/content/index';
import ParsedApiSpecInterface from 'lib/services/api/ParsedApiSpecInterface';
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import entities from '../../entities/index';

export type RouteSpec = {
    key: string,
    path: string,
    entity: EntityInterface,
    component: React.ComponentClass<any, any>
};
const routes: Array<RouteSpec> = [];

export const parseRoutes = (apiSpec: ParsedApiSpecInterface): RouteSpec[] => {

    const routes: Array<RouteSpec> = [];

    for (const name in entities) {
        const entity = entities[name];

        if (!apiSpec[entity?.iden]) {
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