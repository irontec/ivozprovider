import { RouteMap, RouteMapItem } from './routeMapParser';
import { match } from 'react-router-dom';

const matchRoute = (route: RouteMapItem, match: match, includeChildren = false): RouteMapItem | undefined => {

    const routePaths = [
        route.route,
        route.route + '/create',
        route.route + '/:id/update',
        route.route + '/:id/detailed',
    ];

    if (routePaths.includes(match.path)) {

        const resp: RouteMapItem = { ...route };
        if (!includeChildren) {
            delete resp.children;
        }

        return resp;
    }
};

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

    return matchRoute(route, match);
}

export const filterRouteMapPath = (routeMap: RouteMap, match: match): RouteMapItem | undefined => {

    for (const item of routeMap) {
        for (const child of item.children) {
            const resp = _filterRoutePathItems(child, match);
            if (resp) {
                return resp;
            }
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

    return matchRoute(route, match, true);
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