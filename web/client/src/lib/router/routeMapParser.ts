import EntityInterface from "../entities/EntityInterface";

export interface RouteMapItem {
    entity: EntityInterface,
    route?: string,
    filterBy?: string,
    children?: Array<RouteMapItem>,
}

export type RouteMapBlock = {
    label: string | JSX.Element | null,
    children: Array<RouteMapItem>,
}

export type RouteMap = Array<RouteMapBlock>;

const RouteMapItemParser = (item: RouteMapItem, routPrefix = '', depth = 1): RouteMapItem => {

    if (item.children && item.children.length) {

        const children = item.children?.map((subitem: RouteMapItem) => {
            return RouteMapItemParser(
                subitem,
                `${routPrefix}${item.entity?.path}/:parent_id_${depth}`,
                depth + 1
            );
        });

        item = {
            ...item,
            children
        }
    }

    return {
        ...item,
        route: routPrefix + item.entity?.path
    };
}

const routeMapParser = (map: RouteMap): RouteMap => {

    const resp = map.map((block: RouteMapBlock) => {
        const children = block.children?.map((item: RouteMapItem) => {
            return RouteMapItemParser(item);
        });

        return {
            ...block,
            children
        }
    });

    return resp;
}


export default routeMapParser;