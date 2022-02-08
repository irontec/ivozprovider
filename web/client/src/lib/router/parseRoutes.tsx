import { List, Create, Edit, View } from 'lib/components';
import ParsedApiSpecInterface from 'lib/services/api/ParsedApiSpecInterface';
import EntityService from 'lib/services/entity/EntityService';
import EntityInterface from 'lib/entities/EntityInterface';
import { RouteMap, RouteMapItem } from './routeMapParser';

export interface EntityList {
    [name: string]: Readonly<EntityInterface>
}

export type RouteSpec = {
    key: string,
    path: string,
    entity: EntityInterface,
    component: React.ComponentClass<any, any> | React.FunctionComponent,
};

const parseRouteMapItems = (
    apiSpec: ParsedApiSpecInterface,
    items: RouteMapItem[],
    routeMap: RouteMap
): RouteSpec[] => {

    const routes: Array<RouteSpec> = [];

    for (const routeMapItem of items) {

        const { entity, route, children } = routeMapItem;
        if (!entity || !route) {
            continue;
        }

        const iden = entity.iden;

        const entityService = new EntityService(
            apiSpec[iden].actions,
            apiSpec[iden].properties,
            entity
        );
        const acls = entityService.getAcls();

        if (acls.read) {

            routes.push({
                key: `${iden}-list`,
                path: `${route}`,
                entity: entity,
                component: (props: any): JSX.Element => {
                    return (
                        <List
                            {...props}
                            routeMap={routeMap}
                        />
                    );
                },
            });
        }

        if (acls.create) {
            routes.push({
                key: `${iden}-create`,
                path: `${route}/create`,
                entity: entity,
                component: Create
            });
        }

        if (acls.update) {
            routes.push({
                key: `${iden}-update`,
                path: `${route}/:id/update`,
                entity: entity,
                component: Edit
            });

        } else if (acls.read) {
            routes.push({
                key: `${iden}-detailed`,
                path: `${route}/:id/detailed`,
                entity: entity,
                component: View
            });
        }

        if (children && children.length) {
            const childRoutes = parseRouteMapItems(apiSpec, children, routeMap);
            routes.push(...childRoutes);
        }
    }

    return routes;
}

const parseRoutes = (apiSpec: ParsedApiSpecInterface, routeMap: RouteMap): RouteSpec[] => {

    const routes: Array<RouteSpec> = [];
    for (const entity of routeMap) {

        if (!entity.children) {
            continue;
        }

        const childrenRoutes = parseRouteMapItems(apiSpec, entity.children, routeMap);
        routes.push(...childrenRoutes);
    }

    return routes;
}

export default parseRoutes;