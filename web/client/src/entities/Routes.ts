
import { List, Create, Edit } from 'layout/content/index';
import EntityInterface from './EntityInterface';
import entities from './index';

export type RouteSpec = {
    key: string,
    path: string,
    entity: EntityInterface,
    component: Function
};
const routes:Array<RouteSpec> = [];

for (const name in entities) {
    const entity:EntityInterface = entities[name];

    if (entity.acl.create) {
        routes.push({
            key: `${name}-create`,
            path: `${entity.path}/create`,
            entity: entity,
            component: Create
        });
    }

    if (entity.acl.read) {
        routes.push({
            key: `${name}-list`,
            path: `${entity.path}`,
            entity: entity,
            component: List
        });

        routes.push({
            key: `${name}-detailed`,
            path: `${entity.path}/:id/detailed`,
            entity: entity,
            component: List
        });
    }

    if (entity.acl.update) {
        routes.push({
            key: `${name}-update`,
            path: `${entity.path}/:id/update`,
            entity: entity,
            component: Edit
        });
    }
}

export default routes;