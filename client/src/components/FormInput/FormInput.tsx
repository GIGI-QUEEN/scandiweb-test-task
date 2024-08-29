import { FieldValues, Path, useFormContext } from "react-hook-form";
import "./FormInput.scss";

interface IFormInputProps<T extends FieldValues> {
  name: Path<T>;
  label: string;
  type?: React.HTMLInputTypeAttribute;
  id: string;
}

interface IFormSelectInputProps<T extends FieldValues>
  extends IFormInputProps<T> {
  options: string[];
  handleOptionChange: (option: string) => void;
}

export const FormInput = <T extends FieldValues>({
  label,
  type,
  id,
  name,
}: IFormInputProps<T>) => {
  const {
    register,
    formState: { errors },
  } = useFormContext<T>();
  return (
    <div className="form-field">
      <div className="form-input">
        <label htmlFor="">{label}</label>
        <input type={type} id={id} {...register(name)} />
      </div>
      {errors[name]?.message && (
        <p className="error-message">{String(errors[name]?.message)}</p>
      )}
    </div>
  );
};

export const FormSelectInput = <T extends FieldValues>({
  label,
  id,
  options,
  handleOptionChange,
  name,
}: IFormSelectInputProps<T>) => {
  const { register, resetField } = useFormContext<T>();

  const { onChange, ...rest } = register(name);
  return (
    <div className="form-field">
      <div className="form-input">
        <label>{label}</label>
        <select
          //name="type-switch"
          id={id}
          onChange={(e) => {
            onChange(e);

            handleOptionChange(e.target.value);
          }}
          //{...register(name)}
          {...rest}
        >
          {options.map((option) => (
            <option value={option} key={option}>
              {option}
            </option>
          ))}
        </select>
      </div>
    </div>
  );
};
