import { AboutMe, EntityAcl } from 'store/clientSession/aboutMe';
import { useState, useEffect } from 'react';
import { ExtendedRouteMap, ExtendedRouteMapItem } from './EntityMap';
import { isEntityItem } from '@irontec/ivoz-ui';

interface updateEntityMapProps {
  entityMap: ExtendedRouteMap;
  aboutMe: AboutMe;
}

const updateEntityMapByAcls = (
  props: updateEntityMapProps
): ExtendedRouteMap => {
  const { entityMap, aboutMe } = props;
  //const originalEntityMapStr = JSON.stringify(entityMap);
  let updated = false;

  for (const block of entityMap) {
    for (const idx in block.children) {
      const resp = updateRouteMapItemByAcls({
        routeMapItem: block.children[idx],
        aboutMe,
        updated,
      });

      updated = updated || resp[1];

      if (!resp[0]) {
        delete block.children[idx];
        updated = true;
        continue;
      }

      block.children[idx] = resp[0];
    }

    block.children = block.children.filter((item) => item);
  }

  if (!updated) {
    return entityMap;
  }

  return [...entityMap];
};

interface updateRouteMapProps {
  routeMapItem: ExtendedRouteMapItem;
  aboutMe: AboutMe;
  updated: boolean;
}

const updateRouteMapItemByAcls = (
  props: updateRouteMapProps
): [ExtendedRouteMapItem | null, boolean] => {
  const { routeMapItem, aboutMe } = props;
  let { updated } = props;

  const isAccessible = routeMapItem.isAccessible;
  if (isAccessible && !isAccessible(aboutMe)) {
    return [null, true];
  }

  if (!aboutMe.restricted) {
    return [routeMapItem, updated];
  }

  if (!isEntityItem(routeMapItem)) {
    return [routeMapItem, updated];
  }

  const entity = routeMapItem.entity;
  const entityAcls = entity.acl;

  if (!entityAcls || !entityAcls.iden) {
    console.warn(`Unable to calculate ACLs for ${entity.iden}`);
    return [routeMapItem, updated];
  }

  const apiAcls: EntityAcl | undefined = aboutMe.acls.find(
    (acl) => entityAcls?.iden === acl.iden
  );

  if (!apiAcls) {
    return [routeMapItem, updated];
  }

  // TODO updated
  const newAcls = {
    read: entityAcls.read && apiAcls.read,
    create: entityAcls.create && apiAcls.create,
    update: entityAcls.update && apiAcls.update,
    delete: entityAcls.delete && apiAcls.delete,
  };
  routeMapItem.entity = {
    ...entity,
    acl: {
      ...entityAcls,
      ...newAcls,
    },
  };

  if (JSON.stringify(entityAcls) !== JSON.stringify(newAcls)) {
    updated = true;
  }

  if (!routeMapItem.children) {
    return [routeMapItem, updated];
  }

  for (const idx in routeMapItem.children) {
    const result = updateRouteMapItemByAcls({
      routeMapItem: routeMapItem.children[idx],
      aboutMe,
      updated,
    });

    const resp = result[0];
    updated = updated || result[1];

    if (!resp) {
      delete routeMapItem.children[idx];
      updated = true;
      continue;
    }

    routeMapItem.children[idx] = resp;
  }

  routeMapItem.children = routeMapItem.children.filter((item) => item);

  return [routeMapItem, updated];
};

export interface AppRoutesProps {
  entityMap: ExtendedRouteMap;
  aboutMe: AboutMe | null;
}

export default function useAclFilteredEntityMap(
  props: AppRoutesProps
): ExtendedRouteMap {
  const { entityMap, aboutMe } = props;
  const [routes, setRoutes] = useState<ExtendedRouteMap>(entityMap);

  useEffect(() => {
    if (!aboutMe) {
      return;
    }

    const resp = updateEntityMapByAcls({
      entityMap: routes,
      aboutMe,
    });
    setRoutes(resp);
  }, [routes, aboutMe]);

  return routes;
}
