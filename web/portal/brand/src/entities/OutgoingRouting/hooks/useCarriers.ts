import { DropdownArrayChoices } from '@irontec/ivoz-ui';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import { CarrierProperties } from '../../Carrier/CarrierProperties';
import OutgoingRoutingSelectOptions from '../../Carrier/SelectOptions/OutgoingRoutingSelectOptions';

export const useCarriers = (routingMode: string) => {
  const [carriers, setCarriers] = useState<DropdownArrayChoices | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setCarriers(null);

    OutgoingRoutingSelectOptions({
      callback: (data) => {
        const options: DropdownArrayChoices = [];
        for (const item of data as CarrierProperties[]) {
          const validOption =
            item.hasServers && (routingMode === 'static' || item.calculateCost);
          if (validOption) {
            options.push({
              id: item.id as number,
              label: item.name as string,
            });
          }
        }
        setCarriers(options);
      },
      cancelToken,
    });
  }, [routingMode, cancelToken]);

  return carriers;
};
