import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import { CalculateCostSelectOptions } from '../../Carrier/SelectOptions';

export const useCarriers = (routingMode: string) => {
  const [carriers, setCarriers] = useState<Record<number, string> | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setCarriers(null);

    if (routingMode !== 'lcr') {
      return;
    }

    CalculateCostSelectOptions({
      callback: (options) => {
        setCarriers(options || []);
      },
      cancelToken,
    });
  }, [routingMode, cancelToken]);

  return carriers;
};
