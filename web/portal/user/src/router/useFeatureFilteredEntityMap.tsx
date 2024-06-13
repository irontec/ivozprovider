import { EntityItem, isEntityItem, RouteMapItem } from '@irontec/ivoz-ui';
import { useEffect, useState } from 'react';

import { Status } from '../components/Header/useTerminalStatus';
import { ExtendedRouteMap, ExtendedRouteMapItem } from './EntityMap';

interface updateEntityMapProps {
  entityMap: ExtendedRouteMap;
  status: Status;
}

const updateEntityMapByAcls = (
  props: updateEntityMapProps
): ExtendedRouteMap => {
  const { entityMap, status } = props;

  for (const key in entityMap) {
    const block = entityMap[key] as EntityItem;

    const resp = updateRouteMapItemByAcls({
      routeMapItem: block,
      status,
    });

    if (!resp) {
      delete entityMap[key];
      continue;
    }

    entityMap[key] = resp;

    if (!block.children || block.children.length === 0) {
      continue;
    }

    for (const idx in block.children) {
      const resp = updateRouteMapItemByAcls({
        routeMapItem: block.children[idx],
        status,
      });

      if (!resp) {
        delete block.children[idx];
        continue;
      }

      block.children[idx] = resp;
    }

    block.children = block.children.filter((item) => item);
  }

  const response = entityMap.filter((item) => {
    if (isEntityItem(item as RouteMapItem)) {
      return true;
    }

    const children = (item as EntityItem).children as
      | Array<unknown>
      | undefined;

    return !children || children?.length > 0;
  });

  return response;
};

interface updateRouteMapProps {
  routeMapItem: ExtendedRouteMapItem;
  status: Status;
}

const updateRouteMapItemByAcls = (
  props: updateRouteMapProps
): ExtendedRouteMapItem | null => {
  const { routeMapItem, status } = props;

  const isAccessible = routeMapItem.isAccessible;
  if (isAccessible && !isAccessible(status)) {
    return null;
  }

  if (!isEntityItem(routeMapItem)) {
    return routeMapItem;
  }

  if (!routeMapItem.children) {
    return routeMapItem;
  }

  for (const idx in routeMapItem.children) {
    const resp = updateRouteMapItemByAcls({
      routeMapItem: routeMapItem.children[idx],
      status,
    });

    if (!resp) {
      delete routeMapItem.children[idx];
      continue;
    }

    routeMapItem.children[idx] = resp;
  }

  routeMapItem.children = routeMapItem.children.filter((item) => item);

  return routeMapItem;
};

export interface AppRoutesProps {
  entityMap: ExtendedRouteMap;
  status: Status | null;
}

export default function useFeatureFilteredEntityMap(
  props: AppRoutesProps
): ExtendedRouteMap {
  const { entityMap, status } = props;

  const [emptyEntityMap] = useState<ExtendedRouteMap>([]);
  const [routes, setRoutes] = useState<ExtendedRouteMap>(emptyEntityMap);

  useEffect(() => {
    if (!status) {
      setRoutes(emptyEntityMap);

      return;
    }

    const resp = updateEntityMapByAcls({
      entityMap,
      status,
    });

    setRoutes(resp);
  }, [emptyEntityMap, entityMap, status]);

  return routes;
}
