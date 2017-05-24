

<div id="setting">
    <div class="Background-shadow"></div>
    <div id="setting-style">
        <i id="setting-return" class="material-icons character-Close">clear</i>
        <form method="get" action="<?php echo e(url('/settings')); ?>" id="settings">
            <?php echo e(csrf_field()); ?>

            <div class="register-center">

                <div class="register-first">
                    <i class="material-icons">person</i>
                    <input id="settingName" type="text" name="name" value="<?php if(isset(Auth::user()->name)): ?> <?php echo e(old('name',Auth::user()->name)); ?> <?php else: ?> '' <?php endif; ?>" placeholder="First Name">
                    <div class="clearfix"></div>
                    <p></p>
                    <?php if($errors->has('name')): ?> <?php echo e($errors->first('name')); ?> <?php endif; ?>
                </div>
                <div class="register-last">
                    <input type="text"  id="settingLastName" name="last_name" value="<?php if(isset(Auth::user()->last_name)): ?> <?php echo e(old('last_name',Auth::user()->last_name)); ?> <?php else: ?> '' <?php endif; ?>" placeholder="Last Name">
                    <div class="clearfix"></div>
                    <p style="bottom: -34px;"></p>
                    <?php if($errors->has('last_name')): ?> <?php echo e($errors->first('last_name')); ?> <?php endif; ?>
                </div>
                <div class="clearfix"></div>
                <div>
                    <i class="material-icons">work</i>
                    <input id="settingCompany" type="text" name="company" value="<?php if(isset(Auth::user()->company)): ?> <?php echo e(old('company',Auth::user()->company)); ?> <?php else: ?> '' <?php endif; ?>" placeholder="Company Name">
                    <div class="clearfix"></div>
                    <p></p>
                    <?php if($errors->has('company')): ?> <?php echo e($errors->first('company')); ?> <?php endif; ?>
                </div>
                <div>
                    <i class="material-icons">phone</i>
                    <input id="settingPhone" type="text" name="phone" value="<?php if(isset(Auth::user()->phone)): ?> <?php echo e(old('phone',Auth::user()->phone)); ?> <?php else: ?> '' <?php endif; ?>" placeholder="Phone number">
                    <div class="clearfix"></div>
                    <p></p>
                    <?php if($errors->has('company')): ?> <?php echo e($errors->first('company')); ?> <?php endif; ?>
                </div>
                <div>
                    <i class="material-icons">mail_outline</i>
                    <input id="settingEmail" type="email" name="email" value="<?php if(isset(Auth::user()->email)): ?> <?php echo e(old('email',Auth::user()->email)); ?> <?php else: ?> '' <?php endif; ?>" placeholder="Email">
                    <div class="clearfix"></div>
                    <p></p>
                    <?php if($errors->has('email')): ?> <?php echo e($errors->first('email')); ?> <?php endif; ?>
                </div>
                <div>
                    <i class="material-icons">vpn_key</i>
                    <input id="settingPassword" type="password" name="password" value="<?php if(isset(Auth::user()->password)): ?><?php echo e(old('password',Auth::user()->password)); ?><?php else: ?>''<?php endif; ?>"  placeholder="Password" >
                    <div class="clearfix"></div>
                    <p></p>
                    <?php if($errors->has('password')): ?> <?php echo e($errors->first('password')); ?> <?php endif; ?>
                </div>
                <div>
                    <i class="material-icons">vpn_key</i>
                    <input id="settingPasswordConfirm" type="password" name="password_confirmation" value="<?php if(isset(Auth::user()->password)): ?><?php echo e(old('password',Auth::user()->password)); ?><?php else: ?>''  <?php endif; ?>" placeholder="Confirm password">
                    <div class="clearfix"></div>
                    <p></p>
                    <?php if($errors->has('password_confirmation')): ?> <?php echo e($errors->first('password_confirmation')); ?> <?php endif; ?>
                </div>
            </div>
            <div class="registerLogin">
                <button id="settingSubmit" type="button">Submit</button>
            </div>
        </form>
    </div>
</div>


