import { useEffect, useState } from 'react';
import { useStoreState } from 'store';
import getEntityMap, { ExtendedRouteMap } from './EntityMap';
import useAclFilteredEntityMap from './useAclFilteredEntityMap';

export default function useEntityMap(): ExtendedRouteMap {
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const [entityMap, setEntityMap] = useState<ExtendedRouteMap>(getEntityMap());

  useEffect(() => {
    setEntityMap(getEntityMap());
  }, [aboutMe]);

  const aclFilteredEntityMap = useAclFilteredEntityMap({
    entityMap,
    aboutMe,
  });

  return aclFilteredEntityMap;
}
