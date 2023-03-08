import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { EntityValue } from '@irontec/ivoz-ui';
import { DdiProperties, DdiPropertyList } from './DdiProperties';

const properties: DdiProperties = {};

const Ddi: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Ddi',
  title: _('Ddi', { count: 2 }),
  path: '/Ddis',
  toStr: (row: DdiPropertyList<EntityValue>) => row.ddie164 as string,
  properties,
};

export default Ddi;
