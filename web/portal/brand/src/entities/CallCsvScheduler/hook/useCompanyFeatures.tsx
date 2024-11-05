import { useStoreActions } from '@irontec/ivoz-ui';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import FeaturesRelCompany from 'client/src/entities/FeaturesRelCompany/FeaturesRelCompany';
import { useEffect, useState } from 'react';

import { useStoreState } from '../../../store';
import { ClientFeatures, ClientTypes } from '../../Company/ClientFeatures';

export const useCompanyFeatures = (
  companyId: number | string | null,
  companyType: ClientTypes
) => {
  const [companyFeatures, setCompanyFeatures] = useState(
    [] as Array<ClientFeatures>
  );
  const [, cancelToken] = useCancelToken();
  const apiGet = useStoreActions((actions) => actions.api.get);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const hasFaxesFeature = aboutMe?.features.includes(ClientFeatures.faxes);
  const hasFriendsFeature = aboutMe?.features.includes(ClientFeatures.friends);

  const hasFeaturesInBrand = hasFaxesFeature || hasFriendsFeature;
  const isValidCompanyType =
    companyType === ClientTypes.vpbx || companyType === ClientTypes.residential;

  useEffect(() => {
    if (!hasFeaturesInBrand) {
      return;
    }

    if (!isValidCompanyType) {
      return;
    }

    if (!companyId || companyId === '__null__') {
      return;
    }

    apiGet({
      path: FeaturesRelCompany.path,
      params: {
        company: companyId,
        _properties: ['feature'],
      },
      successCallback: async (features) => {
        if (!Array.isArray(features)) {
          return;
        }

        setCompanyFeatures(features.map((f) => f.feature.iden));
      },
    });
  }, [companyId, cancelToken]);

  return companyFeatures;
};
