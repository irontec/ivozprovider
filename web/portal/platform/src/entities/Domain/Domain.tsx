import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SipIcon from '@mui/icons-material/Sip';

import { DomainProperties, DomainPropertyList } from './DomainProperties';

const properties: DomainProperties = {
  domain: {
    label: _('SIP domain', { count: 1 }),
  },
  companyName: {
    label: _('Client', { count: 1 }),
  },
  brandName: {
    label: _('Brand', { count: 1 }),
  },
};

const Domain: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SipIcon,
  link: '/doc/en/administration_portal/platform/sip_domains.html',
  iden: 'Domain',
  title: _('SIP domain', { count: 2 }),
  path: '/domains',
  toStr: (row: DomainPropertyList<EntityValue>) => row.domain as string,
  properties,
  columns: ['domain', 'brandName', 'companyName'],
  acl: {
    read: true,
    detail: false,
    create: false,
    update: false,
    delete: false,
  },
};

export default Domain;
