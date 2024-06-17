import {
  FieldsetGroups,
  View as DefaultEntityView,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { ViewProps } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

const View = (props: ViewProps): JSX.Element | null => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Information'),
      fields: ['startTime', 'duration', 'direction', 'caller', 'callee'],
    },
    {
      legend: _('Extra Information'),
      fields: ['callid', 'endpointType', 'endpointId', 'endpointName'],
    },
  ];

  return <DefaultEntityView {...props} groups={groups} />;
};

export default View;
