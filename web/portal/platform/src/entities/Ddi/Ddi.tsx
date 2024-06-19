import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { DdiProperties, DdiPropertyList } from './DdiProperties';

const properties: DdiProperties = {};

const Ddi: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  link: '/doc/en/administration_portal/client/vpbx/ddis.html',
  iden: 'Ddi',
  title: _('DDI', { count: 2 }),
  path: '/ddis',
  toStr: (row: DdiPropertyList<EntityValue>) => row.ddie164 as string,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'DDIs',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default Ddi;
