import {
  FieldsetGroups,
  View as DefaultEntityView,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ViewProps } from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const View = (props: ViewProps): JSX.Element | null => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Information'),
      fields: ['calldate', 'caller', 'duration'],
    },
    {
      legend: _('Recording', { count: 1 }),
      fields: ['recordingFile'],
    },
  ];

  return <DefaultEntityView {...props} groups={groups} />;
};

export default View;
