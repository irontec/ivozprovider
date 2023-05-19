import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CampaignIcon from '@mui/icons-material/Campaign';

import RecordingExtension from './Field/RecordingExtension';
import { LocutionProperties } from './LocutionProperties';

const properties: LocutionProperties = {
  name: {
    label: _('Name'),
  },
  originalFile: {
    label: _('Uploaded file'),
    type: 'file',
  },
  recordingExtension: {
    label: _('Recording extension'),
    helpText: _(
      'You can call this extension from any company terminal to record this locution'
    ),
    component: RecordingExtension,
  },
  status: {
    label: _('Status'),
    readOnly: true,
    enum: {
      pending: _('pending'),
      encoding: _('encoding'),
      ready: _('ready'),
      error: _('error'),
    },
  },
};

const locution: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CampaignIcon,
  iden: 'Locution',
  title: _('Locution', { count: 2 }),
  path: '/locutions',
  properties,
  columns: ['name', 'originalFile', 'recordingExtension', 'status'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Locutions',
  },
  toStr: (row: EntityValues) => row.name as string,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default locution;
