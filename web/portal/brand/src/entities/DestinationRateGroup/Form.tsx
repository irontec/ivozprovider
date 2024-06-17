import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior/Form';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, edit = false } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    edit && {
      legend: '',
      fields: [edit && 'file', edit && 'status', edit && 'lastExecutionError'],
    },
    {
      legend: '',
      fields: [
        {
          name: 'name',
          size: {
            md: 12,
            lg: 6,
            xl: 6,
          },
        },
        {
          name: 'description',
          size: {
            md: 12,
            lg: 6,
            xl: 6,
          },
        },
        {
          name: 'currency',
          size: {
            md: 12,
            lg: 6,
            xl: 6,
          },
        },
        {
          name: 'deductibleConnectionFee',
          size: {
            md: 12,
            lg: 6,
            xl: 6,
          },
        },
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
