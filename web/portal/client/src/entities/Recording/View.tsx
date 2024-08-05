import {
  FieldsetGroups,
  View as DefaultEntityView,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ViewProps } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const View = (props: ViewProps): JSX.Element | null => {
  const Ddi = store.getState().entities.entities.Ddi;
  const isChildrenOfDdi =
    props.match.pattern.path.indexOf(Ddi.localPath || '_') !== 0;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: [
        'caller',
        'callee',
        'duration',
        'recordedFile',
        !isChildrenOfDdi && 'typeGhost',
      ],
    },
  ];

  return <DefaultEntityView {...props} groups={groups} />;
};

export default View;
