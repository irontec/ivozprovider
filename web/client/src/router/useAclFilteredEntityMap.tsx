import { AboutMe, EntityAcl } from 'store/clientSession/aboutMe';
import { useState, useEffect } from 'react';
import { ExtendedRouteMap, ExtendedRouteMapItem } from './EntityMap';

interface updateEntityMapProps {
  entityMap: ExtendedRouteMap,
  aboutMe: AboutMe
}

const updateEntityMapByAcls = (props: updateEntityMapProps): ExtendedRouteMap => {
  const { entityMap, aboutMe } = props;
  const originalEntityMapStr = JSON.stringify(entityMap);

  for (const block of entityMap) {
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

    block.children = block.children.filter(item => item);
  }

  if (originalEntityMapStr === JSON.stringify(entityMap)) {
    return entityMap;
  }

  return [...entityMap];
};

interface updateRouteMapProps {
  routeMapItem: ExtendedRouteMapItem,
  aboutMe: AboutMe
}

const updateRouteMapItemByAcls = (props: updateRouteMapProps): ExtendedRouteMapItem | null => {

  const { routeMapItem, aboutMe } = props;

  const isAccessible = routeMapItem.isAccessible;
  if (isAccessible && !isAccessible(aboutMe)) {
    return null;
  }

  if (!aboutMe.restricted) {
    routeMapItem;
  }

  const entity = routeMapItem.entity;
  const entityAcls = entity.acl;

  if (!entityAcls || !entityAcls.iden) {
    console.warn(`Unable to calculate ACLs for ${entity.iden}`);
    return routeMapItem;
  }

  const apiAcls: EntityAcl | undefined = aboutMe.acls.find(
    (acl) => entityAcls?.iden === acl.iden,
  );

  if (!apiAcls) {
    return routeMapItem;
  }

  routeMapItem.entity = {
    ...entity,
    acl: {
      ...entityAcls,
      read: entityAcls.read && apiAcls.read,
      create: entityAcls.create && apiAcls.create,
      update: entityAcls.update && apiAcls.update,
      delete: entityAcls.delete && apiAcls.delete,
    },
  };

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

  routeMapItem.children = routeMapItem.children.filter(item => item);

  return routeMapItem;
};

export interface AppRoutesProps {
  entityMap: ExtendedRouteMap,
  aboutMe: AboutMe | null
}

export default function useAclFilteredEntityMap(props: AppRoutesProps): ExtendedRouteMap {

  const { entityMap, aboutMe } = props;
  const [routes, setRoutes] = useState<ExtendedRouteMap>(entityMap);

  useEffect(
    () => {

      if (!aboutMe) {
        return;
      }

      const resp = updateEntityMapByAcls({
        entityMap,
        aboutMe,
      });
      setRoutes(resp);
    },
    [entityMap, aboutMe],
  );

  return routes;
}
