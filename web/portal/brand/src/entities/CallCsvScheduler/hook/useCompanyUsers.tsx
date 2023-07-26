import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useEffect, useState } from 'react';

import { CompanyUserSelectOptions } from '../../User/SelectOptions';

export const useCompanyUsers = (companyId: number | string | null) => {
  const [users, setUsers] = useState<Record<number, string> | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setUsers(null);

    if (!companyId || companyId === '__null__') {
      return;
    }

    CompanyUserSelectOptions(
      {
        callback: (options) => {
          setUsers(options || []);
        },
        cancelToken,
      },
      {
        companyId: companyId as number,
      }
    );
  }, [companyId, cancelToken]);

  return users;
};
