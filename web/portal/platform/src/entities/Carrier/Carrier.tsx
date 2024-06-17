import { EntityValue } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CarrierProperties, CarrierPropertyList } from './CarrierProperties';

const properties: CarrierProperties = {};

const Carrier: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  link: '/doc/en/administration_portal/brand/providers/carriers.html',
  iden: 'Carrier',
  title: _('Carrier', { count: 2 }),
  path: '/carriers',
  toStr: (row: CarrierPropertyList<EntityValue>) => row.name as string,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Carriers',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default Carrier;
