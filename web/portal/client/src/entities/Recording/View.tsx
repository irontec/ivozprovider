import {
  FieldsetGroups,
  View as DefaultEntityView,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { ViewProps } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

const View = (props: ViewProps): JSX.Element | null => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['caller', 'callee', 'duration', 'recordedFile', 'typeGhost'],
    },
  ];

  return <DefaultEntityView {...props} groups={groups} />;
};

export default View;
