import { EntityValues, StoreContainer } from '@irontec/ivoz-ui';
import {
  entityObject2ListLink,
  GenericForeignKeyResolverProps,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { DdiPropertiesList } from '../Ddi/DdiProperties';
import { ClientTypes } from './ClientFeatures';
import { CompanyPropertiesList } from './CompanyProperties';

export default async function genericCompanyForeignKeyResolver(
  props: Omit<GenericForeignKeyResolverProps, 'entity'>
): Promise<Array<EntityValues> | EntityValues> {
  const { data, cancelToken } = props;
  const entities = store.getState().entities.entities;
  const { Company, VirtualPbx, Retail, Residential, Wholesale } = entities;
  const { path } = Company;

  const getAction = StoreContainer.store.getActions().api.get;
  const companyIds = (data as DdiPropertiesList).map(
    (ddi) => ddi.company as number
  );

  await getAction({
    path,
    params: {
      id: companyIds,
      _pagination: false,
      _itemsPerPage: 1000,
    },
    cancelToken: cancelToken,
    successCallback: async (response) => {
      const companies = response as CompanyPropertiesList;
      const vpbx = [];
      const retail = [];
      const residential = [];
      const wholesale = [];
      const ddis = data as DdiPropertiesList;

      for (const ddi of ddis) {
        const company = companies.find((company) => company.id === ddi.company);

        if (company?.type === ClientTypes.vpbx) {
          vpbx.push(ddi);
        }
        if (company?.type === ClientTypes.retail) {
          retail.push(ddi);
        }
        if (company?.type === ClientTypes.residential) {
          residential.push(ddi);
        }
        if (company?.type === ClientTypes.wholesale) {
          wholesale.push(ddi);
        }
      }

      await entityObject2ListLink(
        {
          ...props,
          entity: VirtualPbx,
        },
        vpbx,
        companies
      );
      await entityObject2ListLink(
        { ...props, entity: Retail },
        retail,
        companies
      );
      await entityObject2ListLink(
        {
          ...props,
          entity: Residential,
        },
        residential,
        companies
      );
      await entityObject2ListLink(
        {
          ...props,
          entity: Wholesale,
        },
        wholesale,
        companies
      );
    },
  });

  return data;
}
