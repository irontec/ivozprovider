import { isEntityItem } from '@irontec/ivoz-ui';
import { useEffect, useState } from 'react';
import { AboutMe, EntityAcl } from 'store/clientSession/aboutMe';

import { ExtendedRouteMap, ExtendedRouteMapItem } from './EntityMap';

interface updateEntityMapProps {
  entityMap: ExtendedRouteMap;
  aboutMe: AboutMe;
}

const updateEntityMapByAcls = (
  props: updateEntityMapProps
): ExtendedRouteMap => {
  const { entityMap, aboutMe } = props;

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

    block.children = block.children.filter((item) => item);
  }

  return entityMap.filter((item) => item.children.length > 0);
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

  const aclOverride = routeMapItem.aclOverride;
  if (aclOverride && isEntityItem(routeMapItem)) {
    routeMapItem.entity.acl = aclOverride(aboutMe);
  }

  if (!isEntityItem(routeMapItem)) {
    return routeMapItem;
  }

  if (aboutMe.restricted) {
    const entity = routeMapItem.entity;
    const entityAcls = entity.acl;

    if (!entityAcls || !entityAcls.iden) {
      // eslint-disable-next-line no-console
      console.warn(`Unable to calculate ACLs for ${entity.iden}`);

      return routeMapItem;
    }

    const apiAcls: EntityAcl | undefined = aboutMe.acls.find(
      (acl: { iden: string }) => entityAcls?.iden === acl.iden
    );

    if (apiAcls) {
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
    }
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
