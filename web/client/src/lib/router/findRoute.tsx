import { RouteMap, RouteMapItem } from './routeMapParser';
import { match } from 'react-router-dom';

const _filterRoutePathItems = (route: RouteMapItem, match: match): RouteMapItem | undefined => {

    if (route.children) {
        for (const child of route.children) {
            const resp = _filterRoutePathItems(child, match);
            if (resp) {
                return {
                    ...route,
                    children: [
                        resp
                    ]
                };
            }
        }
    }

    const routePaths = [
        route.route,
        route.route + '/create',
        route.route + '/:id/update',
        route.route + '/:id/detailed',
    ];

    if (routePaths.includes(match.path)) {
        return { entity: route.entity, route: route.route };
    }
}

export const filterRouteMapPath = (routeMap: RouteMap, match: match): RouteMapItem | undefined => {

    for (const item of routeMap) {
        for (const child of item.children) {
            return _filterRoutePathItems(child, match);
        }
    }
}

const _findRoute = (route: RouteMapItem, match: match): RouteMapItem | undefined => {

    if (route.children) {
        for (const child of route.children) {
            const resp = _findRoute(child, match);
            if (resp) {
                return resp;
            }
        }
    }

    if (route.route === match.path) {
        return route;
    }
}

const findRoute = (routeMap: RouteMap, match: match): RouteMapItem | undefined => {
    for (const item of routeMap) {
        for (const child of item.children) {
            const resp = _findRoute(child, match);
            if (resp) {
                return resp;
            }
        }
    }
}

export default findRoute;