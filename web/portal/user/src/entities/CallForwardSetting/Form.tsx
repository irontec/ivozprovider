import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);

  const isCallForwardNoAnswer = formik.values?.callForwardType === 'noAnswer';

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'enabled',
        'callTypeFilter',
        'callForwardType',
        isCallForwardNoAnswer && 'noAnswerTimeout',
        'targetType',
        'numberCountry',
        'numberValue',
        'extension',
        'voicemail',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
