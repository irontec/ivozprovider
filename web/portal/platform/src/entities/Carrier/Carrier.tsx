import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CarrierProperties, CarrierPropertyList } from './CarrierProperties';

const properties: CarrierProperties = {};

const Carrier: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Carrier',
  title: _('Carrier', { count: 2 }),
  path: '/Carriers',
  toStr: (row: CarrierPropertyList<EntityValue>) => row.name as string,
  properties,
};

export default Carrier;
