import { useState } from 'react';

import getEntityMap, { ExtendedRouteMap } from './EntityMap';

export default function useEntityMap(): ExtendedRouteMap {
  const [entityMap] = useState<ExtendedRouteMap>(getEntityMap());

  return entityMap;
}
