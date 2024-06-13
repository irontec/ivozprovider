import { useEffect, useState } from 'react';

import { useStoreState } from '../store';
import getEntityMap, { ExtendedRouteMap } from './EntityMap';
import useFeatureFilteredEntityMap from './useFeatureFilteredEntityMap';

export default function useEntityMap(): ExtendedRouteMap {
  const status = useStoreState((state) => state.userStatus.status.profile);

  const [entityMap, setEntityMap] = useState<ExtendedRouteMap>([]);

  const aclFilteredEntityMap = useFeatureFilteredEntityMap({
    entityMap,
    status,
  });

  useEffect(() => {
    if (entityMap.length) {
      return;
    }

    setEntityMap(getEntityMap());
  }, [status]);

  return aclFilteredEntityMap;
}
