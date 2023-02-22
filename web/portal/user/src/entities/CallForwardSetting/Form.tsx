import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);

  const isCallForwardNoAnswer = formik.values?.callForwardType === 'noAnswer';
  const isNumberTargetType = formik.values?.targetType === 'number';
  const isExtensionTargetType = formik.values?.targetType === 'extension';
  const isVoiceMailTargetType = formik.values?.targetType === 'voicemail';

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'enabled',
        'callTypeFilter',
        'callForwardType',
        isCallForwardNoAnswer && 'noAnswerTimeout',
        'targetType',
        isNumberTargetType && 'numberCountry',
        isNumberTargetType && 'numberValue',
        isExtensionTargetType && 'extension',
        isVoiceMailTargetType && 'voicemail',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
