<?php
require_once __DIR__."/base.php";

class PHPRBACRolesTest extends PHPRBACBaseTest
{
	/**
	 *
	 * @return \jf\RoleManager
	 */
	protected function Instance()
	{
		return jf::$RBAC->Roles;
	}
	protected function type()
	{
		return "role";
	}
	
	function testAssignPermission()
	{
		$ID1 = jf::$RBAC->Roles->Add ( "role1", "description of role1" );
		$ID2 = jf::$RBAC->Roles->Add ( "role2", "description of role2" );
		$ID11 = jf::$RBAC->Roles->Add ( "role1-1", "description of role", $ID1 );
		$ID12 = jf::$RBAC->Roles->Add ( "role1-2", "description of role", $ID1 );
		$ID121 = jf::$RBAC->Roles->Add ( "role1-2-1", "description of role", $ID12 );
		
		$PID1 = jf::$RBAC->Permissions->Add ( "permission1", "description" );
		$PID2 = jf::$RBAC->Permissions->Add ( "permission2", "description" );
		$PID21 = jf::$RBAC->Permissions->Add ( "permission2-1", "description", $PID2 );
		
		jf::$RBAC->Roles->assign ( $ID121, $PID2 );
		
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID121, $PID2 ) );
		
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID1, $PID21 ) );
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID12, $PID2 ) );
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID121, $PID21 ) );
		
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID11, $PID21 ) );
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID2, $PID1 ) );
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID2, $PID2 ) );
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID2, $PID21 ) );
	}
	function testHasPermission()
	{
		$ID1 = jf::$RBAC->Roles->Add ( "role1", "description of role1" );
		$ID2 = jf::$RBAC->Roles->Add ( "role2", "description of role2" );
		$ID11 = jf::$RBAC->Roles->Add ( "role1-1", "description of role", $ID1 );
		$ID12 = jf::$RBAC->Roles->Add ( "role1-2", "description of role", $ID1 );
		$ID121 = jf::$RBAC->Roles->Add ( "role1-2-1", "description of role", $ID12 );
		
		$PID1 = jf::$RBAC->Permissions->Add ( "permission1", "description" );
		$PID2 = jf::$RBAC->Permissions->Add ( "permission2", "description" );
		$PID21 = jf::$RBAC->Permissions->Add ( "permission2-1", "description", $PID2 );
		
		jf::$RBAC->Roles->assign ( $ID121, $PID2 );
		
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID1, $PID21 ) );
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID12, $PID2 ) );
		$this->assertTrue ( jf::$RBAC->Roles->hasPermission ( $ID121, $PID21 ) );
	}
	// @depends LibRbacBaseTest::testAssign # how can i depend on another class'
	// test?
	/**
	 * @depends testHasPermission
	 */
	function testUnassignPermissions()
	{
		$ID1 = jf::$RBAC->Roles->Add ( "role1", "description of role1" );
		$ID2 = jf::$RBAC->Roles->Add ( "role2", "description of role2" );
		$ID11 = jf::$RBAC->Roles->Add ( "role1-1", "description of role", $ID1 );
		$ID12 = jf::$RBAC->Roles->Add ( "role1-2", "description of role", $ID1 );
		$ID121 = jf::$RBAC->Roles->Add ( "role1-2-1", "description of role", $ID12 );
		
		$PID1 = jf::$RBAC->Permissions->Add ( "permission1", "description" );
		$PID2 = jf::$RBAC->Permissions->Add ( "permission2", "description" );
		$PID21 = jf::$RBAC->Permissions->Add ( "permission2-1", "description", $PID2 );
		
		jf::$RBAC->Roles->assign ( $ID121, $PID2 );
		

		jf::$RBAC->Roles->unassignPermissions ( $ID121 );
		
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID1, $PID21 ) );
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID12, $PID2 ) );
		$this->assertFalse ( jf::$RBAC->Roles->hasPermission ( $ID121, $PID21 ) );
	}
	
	/**
	 * depends LibRbacUsersTest::testAssign
	 */
	function testUnassignUsers()
	{
		$UID = 2;
		$ID1 = jf::$RBAC->Roles->Add ( "role1", "description of role1" );
		$ID2 = jf::$RBAC->Roles->Add ( "role2", "description of role2" );
		$ID11 = jf::$RBAC->Roles->Add ( "role1-1", "description of role", $ID1 );
		$ID12 = jf::$RBAC->Roles->Add ( "role1-2", "description of role", $ID1 );
		$ID121 = jf::$RBAC->Roles->Add ( "role1-2-1", "description of role", $ID12 );
		$this->assertTrue ( jf::$RBAC->Users->assign ( $ID1, $UID ) );
		
		$this->assertTrue ( jf::$RBAC->Users->hasRole ( $ID1, $UID ) );
		jf::$RBAC->Roles->unassignUsers ( $ID1 );
		$this->assertFalse ( jf::$RBAC->Users->hasRole ( $ID1, $UID ) );
	}
	function testPermissions()
	{
		$ID1 = jf::$RBAC->Roles->Add ( "role1", "description of role1" );
		$ID2 = jf::$RBAC->Roles->Add ( "role2", "description of role2" );
		$ID11 = jf::$RBAC->Roles->Add ( "role1-1", "description of role", $ID1 );
		$ID12 = jf::$RBAC->Roles->Add ( "role1-2", "description of role", $ID1 );
		$ID121 = jf::$RBAC->Roles->Add ( "role1-2-1", "description of role", $ID12 );
		
		$PID1 = jf::$RBAC->Permissions->Add ( "permission1", "description" );
		$PID2 = jf::$RBAC->Permissions->Add ( "permission2", "description" );
		$PID21 = jf::$RBAC->Permissions->Add ( "permission2-1", "description", $PID2 );
		
		jf::$RBAC->Roles->assign ( $ID121, $PID2 );
		$this->assertEquals(jf::$RBAC->Roles->permissions($ID121,true),array($PID2));		
		jf::$RBAC->Roles->assign ( $ID121, $PID1 );
		$this->assertEquals(jf::$RBAC->Roles->permissions($ID121,true),array($PID1,$PID2));		
		$this->assertEquals(2,count(jf::$RBAC->Roles->permissions($ID121)));		
	
	}
}