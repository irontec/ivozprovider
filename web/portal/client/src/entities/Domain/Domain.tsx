import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SipIcon from '@mui/icons-material/Sip';

import { DomainProperties, DomainPropertyList } from './DomainProperties';

const properties: DomainProperties = {};

const Domain: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SipIcon,
  iden: 'Domain',
  title: _('SIP Domain', { count: 2 }),
  path: '/domains',
  toStr: (row: DomainPropertyList<EntityValue>) => row.domain as string,
  properties,
  columns: [],
  selectOptions: async () => {
    const module = await import('./DomainSelectOptions');

    return module.default;
  },
};

export default Domain;
