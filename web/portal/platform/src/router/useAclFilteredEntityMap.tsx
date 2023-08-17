import { EntityItem, isEntityItem, RouteMapItem } from '@irontec/ivoz-ui';
import { useEffect, useState } from 'react';

import { AboutMe, EntityAcl } from '../store/clientSession/aboutMe';
import { ExtendedRouteMap, ExtendedRouteMapItem } from './EntityMap';

interface updateEntityMapProps {
  entityMap: ExtendedRouteMap;
  aboutMe: AboutMe;
}

const updateEntityMapByAcls = (
  props: updateEntityMapProps
): ExtendedRouteMap => {
  const { entityMap, aboutMe } = props;

  for (const key in entityMap) {
    const block = entityMap[key] as EntityItem;

    const resp = updateRouteMapItemByAcls({
      routeMapItem: block,
      aboutMe,
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
        aboutMe,
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
  aboutMe: AboutMe;
}

const updateRouteMapItemByAcls = (
  props: updateRouteMapProps
): ExtendedRouteMapItem | null => {
  const { routeMapItem, aboutMe } = props;

  const isAccessible = routeMapItem.isAccessible;
  if (isAccessible && !isAccessible(aboutMe)) {
    return null;
  }

  if (!aboutMe.restricted) {
    return routeMapItem;
  }

  if (!isEntityItem(routeMapItem)) {
    return routeMapItem;
  }

  const entity = routeMapItem.entity;
  const entityAcls = entity.acl;

  if (!entityAcls || !entityAcls.iden) {
    // eslint-disable-next-line no-console
    console.warn(`Unable to calculate ACLs for ${entity.iden}`);

    return routeMapItem;
  }

  const profileAcls: EntityAcl | undefined = aboutMe.acls.find(
    (acl: EntityAcl) => entityAcls?.iden === acl.iden
  );

  if (!profileAcls) {
    // eslint-disable-next-line no-console
    console.warn(`No ACL rules found for ${entityAcls?.iden}`);

    return null;
  }

  // TODO updated
  const newAcls = {
    read: entityAcls.read && profileAcls.read,
    detail: entityAcls.detail && profileAcls.read,
    create: entityAcls.create && profileAcls.create,
    update: entityAcls.update && profileAcls.update,
    delete: entityAcls.delete && profileAcls.delete,
  };
  routeMapItem.entity = {
    ...entity,
    acl: {
      ...entityAcls,
      ...newAcls,
    },
  };

  const {
    read: canRead,
    detail: canReadDetail,
    create: canCreate,
    update: canUpdate,
    delete: canDelete,
  } = routeMapItem.entity.acl;

  const forbidden = !(
    canRead ||
    canReadDetail ||
    canCreate ||
    canUpdate ||
    canDelete
  );

  if (forbidden) {
    return null;
  }

  if (!routeMapItem.children) {
    return routeMapItem;
  }

  for (const idx in routeMapItem.children) {
    const resp = updateRouteMapItemByAcls({
      routeMapItem: routeMapItem.children[idx],
      aboutMe,
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
  aboutMe: AboutMe | null;
}

export default function useAclFilteredEntityMap(
  props: AppRoutesProps
): ExtendedRouteMap {
  const { entityMap, aboutMe } = props;

  const [emptyEntityMap] = useState<ExtendedRouteMap>([]);
  const [routes, setRoutes] = useState<ExtendedRouteMap>(emptyEntityMap);

  useEffect(() => {
    if (!aboutMe) {
      setRoutes(emptyEntityMap);

      return;
    }

    const resp = updateEntityMapByAcls({
      entityMap,
      aboutMe,
    });
    setRoutes(resp);
  }, [emptyEntityMap, entityMap, aboutMe]);

  return routes;
}
