import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useState, useEffect } from 'react';
import CompanyFriendSelectOptions from '../..//Friend/SelectOptions/CompanyFriendSelectOptions';

export const useCompanyFriends = (companyId: number | string | null) => {
  const [users, setUsers] = useState<Record<number, string> | null>(null);
  const [, cancelToken] = useCancelToken();

  useEffect(() => {
    setUsers(null);

    if (!companyId || companyId === '__null__') {
      return;
    }

    CompanyFriendSelectOptions(
      {
        callback: (options: any) => {
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
