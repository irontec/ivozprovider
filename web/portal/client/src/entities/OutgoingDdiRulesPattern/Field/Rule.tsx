import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import React from 'react';
import { Link } from 'react-router-dom';

import { OutgoingDdiRulesPatternPropertyList } from '../OutgoingDdiRulesPatternProperties';

type OutgoingDdiRulesPatternValues = OutgoingDdiRulesPatternPropertyList<
  string | number | Record<string, string | number>
>;
type RuleGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<OutgoingDdiRulesPatternValues>
>;

const Rule: RuleGhostType = (props): JSX.Element | null => {
  const { values } = props;
  const { type, prefix, matchList, matchListLink } = values;

  if (type === 'prefix') {
    return <span>{prefix as React.ReactNode}</span>;
  }

  if (type === 'destination') {
    if (!matchListLink) {
      return null;
    }

    return (
      <Link to={matchListLink as string}>{matchList as React.ReactNode}</Link>
    );
  }

  return <span>{matchList as React.ReactNode}</span>;
};

export default withCustomComponentWrapper<OutgoingDdiRulesPatternValues>(Rule);
