import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import { CarrierProperties } from '../../Carrier/CarrierProperties';
import OutgoingRoutingSelectOptions from '../../Carrier/SelectOptions/OutgoingRoutingSelectOptions';

export const useCarriers = (routingMode: string) => {
  const [carriers, setCarriers] = useState<Record<number, string> | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setCarriers(null);

    OutgoingRoutingSelectOptions({
      callback: (data) => {
        const options: Record<number, string> = {};
        for (const item of data as CarrierProperties[]) {
          const validOption =
            item.hasServers && (routingMode === 'static' || item.calculateCost);
          if (validOption) {
            options[item.id as number] = item.name as string;
          }
        }
        setCarriers(options);
      },
      cancelToken,
    });
  }, [routingMode, cancelToken]);

  return carriers;
};
