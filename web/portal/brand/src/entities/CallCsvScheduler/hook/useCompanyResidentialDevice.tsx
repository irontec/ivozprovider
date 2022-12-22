import { useState, useEffect } from 'react';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { CompanyResidentialDeviceSelectOptions } from '../..//ResidentialDevice/SelectOptions';

export const useCompanyResidentialDevice = (
  companyId: number | string | null
) => {
  const [residentialDevices, setResidentialDevices] = useState<Record<
    number,
    string
  > | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setResidentialDevices(null);

    if (!companyId || companyId === '__null__') {
      return;
    }

    CompanyResidentialDeviceSelectOptions(
      {
        callback: (options: any) => {
          setResidentialDevices(options || []);
        },
        cancelToken,
      },
      {
        companyId: companyId as number,
      }
    );
  }, [companyId, cancelToken]);

  return residentialDevices;
};
