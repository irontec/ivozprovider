import { AboutMe, EntityAcl } from "store/clientSession/aboutMe";
import { RouteMap, RouteMapItem } from "@irontec/ivoz-ui";
import { useState, useEffect } from "react";

interface updateEntityMapProps {
  entityMap: RouteMap,
  aboutMe: AboutMe
}

const updateEntityMapByAcls = (props: updateEntityMapProps): RouteMap => {
  const { entityMap, aboutMe: acls } = props;
  const originalEntityMapStr = JSON.stringify(entityMap);

  for (const block of entityMap) {
    for (const idx in block.children) {

      block.children[idx] = updateRouteMapItemByAcls({
        routeMapItem: block.children[idx],
        aboutMe: acls
      });
    }
  }

  if (originalEntityMapStr === JSON.stringify(entityMap)) {
    return entityMap;
  }

  return [...entityMap];
}

interface updateRouteMapProps {
  routeMapItem: RouteMapItem,
  aboutMe: AboutMe
}

const updateRouteMapItemByAcls = (props: updateRouteMapProps): RouteMapItem => {

  const { routeMapItem, aboutMe } = props;

  const entity = routeMapItem.entity;
  const entityAcls = entity.acl;

  if (!entityAcls || !entityAcls.iden) {
    console.warn(`Unable to calculate ACLs for ${entity.iden}`);
    return routeMapItem;
  }

  const apiAcls: EntityAcl | undefined = aboutMe.acls.find(
    (acl) => entityAcls?.iden === acl.iden
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
    }
  }

  if (!routeMapItem.children) {
    return routeMapItem;
  }

  for (const idx in routeMapItem.children) {
    routeMapItem.children[idx] = updateRouteMapItemByAcls({
      routeMapItem: routeMapItem.children[idx],
      aboutMe
    });
  }

  return routeMapItem;
}

export interface AppRoutesProps {
  entityMap: RouteMap,
  aboutMe: AboutMe | null
}

export default function useAclFilteredEntityMap(props: AppRoutesProps): RouteMap {

  const { entityMap, aboutMe } = props;
  const [routes, setRoutes] = useState<RouteMap>(entityMap);

  useEffect(
    () => {

      if (!aboutMe) {
        return;
      }

      if (!aboutMe.restricted) {
        return;
      }

      const resp = updateEntityMapByAcls({
        entityMap,
        aboutMe,
      });
      setRoutes(resp);
    },
    [entityMap, aboutMe]
  )

  return routes;
}
