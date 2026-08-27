import DefaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import QueryStatsIcon from '@mui/icons-material/QueryStats';

const channelUsage: EntityInterface = {
  ...DefaultEntityBehavior,
  icon: QueryStatsIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/calls/channel_usage.html',
  iden: 'ChannelUsage',
  title: _('Channel usage'),
  path: '/channel_usages',
  acl: {
    create: false,
    read: true,
    detail: false,
    update: false,
    delete: false,
    iden: 'ChannelUsages',
  },
};

export default channelUsage;
